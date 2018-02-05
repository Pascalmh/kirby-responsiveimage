<?php

$oldFunction = kirbytext::$tags['image'];
kirbytext::$tags['image'] = [
    'attr' => $oldFunction['attr'],
    'html' => function ($tag) use ($oldFunction) {
        $image = $tag->file($tag->attr('image'));

        if (!$image) {
            return $result = call($oldFunction['html'], $tag);
        }

        $widths = c::get(
            'responsiveimage.widths',
            [
                2400,
                2200,
                2000,
                1800,
                1400,
                1200,
                1000,
                800,
                600,
                400,
                320,
            ]
        );

        $srcset = [];
        foreach ($widths as $width) {
            if ($image->width() < $width) {
                continue;
            }

            $imageResized = $image->resize($width);
            $srcset[] = $imageResized->url() . ' ' . $imageResized->width() . 'w';
        }

        $result = call($oldFunction['html'], $tag);
        $result = str_replace('<img', '<img srcset="' . implode(', ', $srcset) . '"', $result->toString());

        return $result;
    }
];
