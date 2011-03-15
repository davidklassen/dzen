<?php
/**
 * Description of ViewHelperLink
 *
 * @author f0rk
 */

class ViewHelperLink {

    /**
     * Creates themed link
     * 
     * @param string $title
     * @param string $path
     * @param array $options
     * @return string
     */
    public function link($title, $path = null, $options = array()) {
    
        /*
         * $options = (
         *     'absolute' => true,
         *     'id' => 'some_id',
         *     'class' => 'come_class'
         *     'target' => '_blank'
         * )   
         * 
         *  
         *   
         */
    
        if ($options['absolute']) {
            $path = ControllerFront::getInstance()->getBaseUrl() . '/' . $path;
        }
    
        if (isset ($options['target'])) {
             $target= 'target="' . $options['target'] . '"';
        }
        
        $output = '<a href="' . $path . '" ' . $target . '>' . $title . '</a>';
        
        return $output;
    }
    
}
