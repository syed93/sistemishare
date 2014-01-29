<?php

namespace JunMy\Components\Pagination;

class Pagination
{

    /**
     *  Constructor of the class.
     *
     *  Initializes the class and the default properties.
     *
     *  @return void
     */
    function Pagination()
    {

        // set default starting page
        $this->page = 1;

        // number of selectable pages
        $this->selectable_pages(11);

        // records per page
        $this->records_per_page(10);

        // by default, we assume there are no records
        // we expect this number to be set after the class is instantiated
        $this->records(0);

        // by default, prefix page number with zeroes
        $this->padding();

        // this is the variable name to be used in the URL for propagating the page number
        $this->variable_name('page');

        // default method for page propagation
        $this->method('get');

        // trailing slashes are added to generated URLs
        // (when "method" is "url")
        $this->trailing_slash(true);

        // set the base url
        $this->base_url();

    }


    function base_url($base_url = '')
    {

        // set the base URL
        $this->_base_url = ($base_url == '' ? $_SERVER['REQUEST_URI'] : $base_url);

        // keep only what is before "?"
        $this->_base_url = (strpos($this->_base_url, '?') !== false ? preg_replace('/^(.*?)\?.*$/', '$1', $this->_base_url) : $this->_base_url);

    }


    function get_page()
    {

        // if page was not already set through the "set_page" method
        if (!isset($this->page_set)) {

            // if
            if (

                // page propagation is SEO friendly
                $this->_method == 'url' &&

                // the current page is set in the URL
                preg_match('/\b' . preg_quote($this->_variable_name) . '([0-9]+)\b/i', $_SERVER['REQUEST_URI'], $matches) > 0

            ) {

                // set the current page to whatever it is indicated in the URL
                $this->set_page((int)$matches[1]);

            // if page propagation is done through GET and the current page is set in $_GET
            } elseif (isset($_GET[$this->_variable_name])) {

                // set the current page to whatever it was set to
                $this->set_page((int)$_GET[$this->_variable_name]);

            }

        }

        // get the total number of pages
        $this->_total_pages = ceil($this->_records / $this->_records_per_page);

        // if there are any pages
        if ($this->_total_pages > 0) {

            // if current page is beyond the total number pages
            /// make the current page be the last page
            if ($this->page > $this->_total_pages) $this->page = $this->_total_pages;

            // if current page is smaller than 1
            // make the current page 1
            elseif ($this->page < 1) $this->page = 1;

        }

        // return the current page
        return $this->page;

    }


    function method($method)
    {

        // by default, we assume page propagation is done through GET
        $this->_method = 'get';

        // make sure method is lowercase
        $method = strtolower($method);

        // if a valid method was specified
        // set the page propagation method
        if ($method == 'get' || $method == 'url') $this->_method = $method;

    }


    function padding($enabled = true)
    {

        // set padding
        $this->_padding = $enabled;

    }


    function records($records)
    {

        // the number of records
        // make sure we save it as an integer
        $this->_records = (int)$records;

    }


    function records_per_page($records_per_page)
    {

        // the number of records displayed on one page
        // make sure we save it as an integer
        $this->_records_per_page = (int)$records_per_page;

    }


    function render($return_output = false)
    {

        // get some properties of the class
        $this->get_page();

        // if there is a single page, or no pages at all, don't display anything
        if ($this->_total_pages <= 1) return '';

        // start building output
        $output = '<div class="pagination">';

        // if the number of total pages available is greater than the number of selectable pages
        // it means we can show the "previous page" link
        if ($this->_total_pages > $this->_selectable_pages) {

            $output .= '<a href="' .

                // the href is different if we're on the first page
                ($this->page == 1 ? 'javascript:void(0)' : $this->_build_uri($this->page - 1)) .

                // if we're on the first page, the link is disabled
                '" class="navigation left' . ($this->page == 1 ? ' disabled' : '') . '"' .

                '>previous page</a>';

        }

        // if the total number of pages is lesser than the number of selectable pages
        if ($this->_total_pages <= $this->_selectable_pages) {

            // iterate through the available pages
            for ($i = 1; $i <= $this->_total_pages; $i++) {

                // render the link for each page
                $output .= '<a href="' . $this->_build_uri($i) . '" ' .

                    // make sure to highlight the currently selected page
                    ($this->page == $i ? 'class="current"' : '') . '>' .

                    // apply padding if required
                    ($this->_padding ? str_pad($i, strlen($this->_total_pages), '0', STR_PAD_LEFT) : $i) .

                    '</a>';

            }

        // if the total number of pages is greater than the number of selectable pages
        } else {

            // put a link to the first page
            $output .= '<a href="' . $this->_build_uri(1) . '" ' .

                // highlight if it is the currently selected page
                ($this->page == 1 ? 'class="current"' : '') . '>' .

                // apply padding if required
                ($this->_padding ? str_pad('1', strlen($this->_total_pages), '0', STR_PAD_LEFT) : '1') .

                '</a>';

        
            $adjacent = floor(($this->_selectable_pages - 3) / 2);

            // this number must be at least "1"
            $adjacent = ($adjacent == 0 ? 1 : $adjacent);

            // compute the page after which to show "..." after the link to the first page
            $scroll_from = $this->_selectable_pages - $adjacent;

            // this is the number from where we should start rendering selectable pages
            // it's "2" because we have already rendered the first page
            $starting_page = 2;

            // if we need to show "..." after the link to the first page
            if ($this->page >= $scroll_from) {

                // by default, the starting_page should be whatever the current page minus $adjacent
                $starting_page = $this->page - $adjacent;

                // but if that would cause us to display less navigation links than specified in $this->_selectable_pages
                if ($this->_total_pages - $starting_page < ($this->_selectable_pages - 2)) {

                    // adjust it
                    $starting_page -= ($this->_selectable_pages - 2) - ($this->_total_pages - $starting_page);

                }

                // put the "..." after the link to the first page
                $output .= '<span>&hellip;</span>';

            }

           
            $ending_page = $starting_page + $this->_selectable_pages - 3;

            
            if ($ending_page > $this->_total_pages - 1) $ending_page = $this->_total_pages - 1;

            // place links for each page
            for ($i = $starting_page; $i <= $ending_page; $i++) {

                $output .= '<a href="' . $this->_build_uri($i) . '" ' .

                    // highlight the currently selected page
                    ($this->page == $i ? 'class="current"' : '') . '>' .

                    // apply padding if required
                    ($this->_padding ? str_pad($i, strlen($this->_total_pages), '0', STR_PAD_LEFT) : $i) .

                    '</a>';

            }

            // place the "..." before the link to the last page, if it is the case
            if ($this->_total_pages - $ending_page > 1) $output .= '<span>&hellip;</span>';

            // put a link to the last page
            $output .= '<a href="' . $this->_build_uri($this->_total_pages) . '" ' .

                // highlight if it is the currently selected page
                ($this->page == $i ? 'class="current"' : '') . '>' .

                $this->_total_pages .

                '</a>';

            // if the total number of available pages is greater than the number of pages to be displayed at once
            // it means we can show the "next page" link
            if ($this->_total_pages > $this->_selectable_pages) {

                $output .= '<a href="' .

                    // the href is different if we're on the last page
                    ($this->page == $this->_total_pages ? 'javascript:void(0)' : $this->_build_uri($this->page + 1)) .

                    // if we're on the last page, the link is disabled
                    '" class="navigation right' . ($this->page == $this->_total_pages ? ' disabled' : '') . '"' .

                    '>next page</a>';

            }

        }

        // finish generating the output
        $output .= '</div>';

        // if $return_output is TRUE
        // return the generated content
        if ($return_output) return $output;

        // if script gets this far, print generated content to the screen
        echo $output;

    }


    function selectable_pages($selectable_pages)
    {

        // the number of selectable pages
        // make sure we save it as an integer
        $this->_selectable_pages = (int)$selectable_pages;

    }

 
    function set_page($page)
    {

        // set the current page
        // make sure we save it as an integer
        $this->page = (int)$page;

        // if the number is lower than one
        // make it '1'
        if ($this->page < 1) $this->page = 1;

        // set a flag so that the "get_page" method doesn't change this value
        $this->page_set = true;

    }


    function trailing_slash($enabled)
    {

        // set the state of trailing slashes
        $this->_trailing_slash = $enabled;

    }


    function variable_name($variable_name)
    {

        // set the variable name
        $this->_variable_name = strtolower($variable_name);

    }


    function _build_uri($page)
    {

        // if page propagation method is through SEO friendly URLs
        if ($this->_method == 'url') {

            // see if the current page is already set in the URL
            if (preg_match('/\b' . $this->_variable_name . '([0-9]+)\b/i', $this->_base_url, $matches) > 0) {

                // build string
                $url = str_replace('//', '/', preg_replace(

                    // replace the currently existing value
                    '/\b' . $this->_variable_name . '([0-9]+)\b/i',

                    // if on the first page, remove it in order to avoid duplicate content
                    ($page == 1 ? '' : $this->_variable_name . $page),

                    $this->_base_url

                ));

            // if the current page is not yet in the URL, set it, unless we're on the first page
            // case in which we don't set it in order to avoid duplicate content
            } else $url = rtrim($this->_base_url, '/') . '/' . ($page != 1 ? $this->_variable_name . $page : '');

            // handle trailing slash according to preferences
            $url = rtrim($url, '/') . ($this->_trailing_slash ? '/' : '');

            // return the built string also appending the query string, if any
            return ($_SERVER['QUERY_STRING'] != '' ? $url . '?' . $_SERVER['QUERY_STRING'] : $url);

        // if page propagation is to be done through GET
        } else {

            // get the current query string, if any, an transform it to an array
            parse_str($_SERVER['QUERY_STRING'], $query);

            // if not the first page 
            if ($page != 1) 

                // add/update the page number
                $query[$this->_variable_name] = $page;

            // for the don't use the "page" variable in order to avoid duplicate content
            else unset($query[$this->_variable_name]);

            // make sure the returned HTML is W3C compliant
            return htmlspecialchars($this->_base_url . (!empty($query) ? '?' . http_build_query($query) : ''));

        }

    }

}

?>