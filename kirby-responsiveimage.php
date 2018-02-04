<?php

kirbytext::$tags['responsiveimage'] = [
    'attr' => [
        'alt',
        'width',
        'height',
        'class',
        'link',
        'popup',
        'caption',
    ],
    'html' => function ($tag) {
        $image = $tag->file($tag->attr('responsiveimage'));

        if (!$image) {
            return null;
        }

        $widths = c::get(
            'tag.responsiveimage.widths',
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

        $img = brick('img');
        $img->attr('src', array_values(array_slice($srcset, -1))[0]);
        $img->attr('srcset', implode(', ', $srcset));
        $img->attr('alt', $tag->attr('alt'));
        $img->attr('width', $tag->attr('width'));
        $img->attr('height', $tag->attr('height'));
        $img->attr('class', $tag->attr('class'));
        c::set('responsiveimage.html', $img);

        if ($href = $tag->attr('link')) {
            $link = brick('a');
            $link->attr('href', url($href));

            if ($tag->attr('popup') === 'yes') {
                $link->attr('target', '_blank');
            }

            $link->append(function () {
                return c::get('responsiveimage.html');
            });

            c::set('responsiveimage.html', $link);
        }

        if (c::get('kirbytext.image.figure', true)) {
            $figure = brick('figure');
            $figure->append(function () {
                return c::get('responsiveimage.html');
            });

            if ($caption = $tag->attr('caption')) {
                c::set('repsonsiveimage.figure.caption', $caption);

                $figure->append(function() {
                    return brick('figcaption', c::get('repsonsiveimage.figure.caption', false));
                });
            }

            c::set('responsiveimage.html', $figure);
        }

        return c::get('responsiveimage.html');
    }
];
