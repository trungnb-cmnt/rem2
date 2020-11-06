@if (!empty($post))
    <?php
        $title = $post->name;
        $description = $post->description;
        $meta = get_meta_data($post->id, 'seo_meta', POST_MODULE_SCREEN_NAME, true);
        if ($meta) {
            if (!empty($meta['seo_title'])) $title = $meta['seo_title'];
            if (!empty($meta['seo_description'])) $description = $meta['seo_description'];
        }
    ?>
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            <?php if ($post->type) : ?>
                "@type": "<?= $post->type ?>",
            <?php else : ?>
                "@type": "article",
            <?php endif ?>
            "name": "<?= $title ?>",
            "image": [
                "<?= get_object_image($post->image, 'medium') ?>"
            ],
            "description": "<?= strip_tags($description) ?>",
            "author": "<?= $post->author->username ?>",
            "datePublished": "<?= $post->publish_date ? $post->publish_date->toDateTimeString() : null ?>",
            "dateModified": "<?= $post->updated_at ? $post->updated_at->toDateTimeString() : null ?>",
            "mainEntityOfPage": "<?= route('public.single', $post->slug) ?>",
            "headline": "<?= strip_tags($description) ?>",
            "publisher": {
               "@type": "Organization",
               "name": "<?= setting('site_title') ?>",
               "logo": {
                    "@type": "ImageObject",
                    "url": "<?= url(theme_option('logo')) ?>",
                    "width": 300
               }
            }
        }
    </script>
@endif
