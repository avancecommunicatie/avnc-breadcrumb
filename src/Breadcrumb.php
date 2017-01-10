<?php namespace avancecommunicatie\Breadcrumb;

class Breadcrumb
{
    protected $_links = array();

    /**
     * Returns array of breadcrumb items.
     *
     * @return array
     */
    public function get() {
        return $this->_links;
    }

    /**
     * Returns true if there are items
     *
     * @return bool
     */
    public function has(){
        return count($this->_links) > 0;
    }

    /**
     * Add item to breadcrumb.
     *
     * @param string $title
     * @param string $href
     */
    public function add($title, $href='#') {
        $this->_links[] = array('title' => $title, 'href' => $href);
    }

    public function isLast($item){
        $links = $this->_links;
        return $item == end($links);
    }

    public function clear(){
        $this->_links = array();
    }

    public function removeLast(){
        array_pop($this->_links);
    }

    public function cacheAdd($title, $href = '#', $reset = false){
        if($reset){
            $cached = [];
        }else{
            $cached = session('breadcrumbs', []);
        }
        $cached[] = compact('title', 'href');
        session()->flash('breadcrumbs', $cached);
    }

    public function cacheUse($auto_home = true){
        $cached = session('breadcrumbs', []);
        if(! empty($cached)) {
            session()->keep(['breadcrumbs']);
            $this->_links = [];

            if ($auto_home) {
                $this->add('Home', route('front.frontpage'));
            }

            foreach ($cached as $cache) {
                $this->add($cache['title'], $cache['href']);
            }
        }
    }
}
