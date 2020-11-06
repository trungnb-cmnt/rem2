<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "url": "<?= url('/') ?>",
        "contactPoint": [
            { "@type": "ContactPoint",
                "telephone": "<?= '+84' . (int)(str_replace('.', '', explode(',', setting('company_phone'))[0])) ?>",
                "contactType": "customer service"
            }
        ]
    }
</script>
