<?php

namespace Shogun\Framework;

class Config {

    protected $theme_path;

    protected $config_file;

    protected $theme_config;

    public function __construct(
        $theme_path = null,
        $config_file = null
    ) {
        $this->theme_path = $theme_path;

        $this->config_file = $config_file;
        
        $this->theme_config = $this->getConfig();
    }

    public function getConfig()
    {
        if ( $this->config_file === null ) {
            $this->config_file = 'theme.json';
        }

        if ( $this->theme_path === null ) {
            $this->theme_path = get_stylesheet_directory();
        }

        return json_decode( file_get_contents( $this->theme_path . '/' . $this->config_file ) , true );
    }

    public function getAll()
    {
        return $this->theme_config;
    }

    public function get( string $key )
    {
        return $this->theme_config[ $key ];
    }
}