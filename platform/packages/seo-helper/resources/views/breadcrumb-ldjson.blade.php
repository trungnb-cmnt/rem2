@if (!empty($breadCrumbs))
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
        <?php if (!empty($breadCrumbs)) : ?>
            <?php foreach ($breadCrumbs as $key => $breadcrumb) : ?>
                {
                "@type": "ListItem",
                "position": "<?= ($key + 1) ?>",
                    "item":
                    {
                        "@type": "Thing",
                        "@id": "<?= $breadcrumb['url'] ?>",
                        "name": "<?= $breadcrumb['label'] ?>"
                    }
                }
                <?php if ($key < count($breadCrumbs) - 1) : ?>,<?php endif ?>
                <?php endforeach ?>
        <?php endif ?>
        ]
    }
    </script>
@endif