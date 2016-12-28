<?php


class ShopHelper extends AppHelper {

    public $helpers = ['Html'];

    public function photoImage($shop, $options = []) {

        $photoDir = Configure::read('Photo.dir');
        $defaultPhoto = Configure::read('Photo.default');

        if (empty($shop['Shop']['photo'])) {
            $path = $defaultPhoto;
        } else {
            $path = $photoDir . $shop['Shop']['photo_dir'] . '/' . $shop['Shop']['photo'];
        }

        return $this->Html->image($path, $options);
    }

    public function scoreList() {
        return [
            1 => '★☆☆☆☆',
            2 => '★★☆☆☆',
            3 => '★★★☆☆',
            4 => '★★★★☆',
            5 => '★★★★★',
        ];
    }
}