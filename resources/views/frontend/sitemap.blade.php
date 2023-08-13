<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://sahrebook.com/produk</loc>
        <lastmod>2023-08-10T18:36:13+00:00</lastmod>
        <changefreq>weekly</changefreq>
    </url>
    <url>
        <loc>https://sahrebook.com/berita</loc>
        <lastmod>2023-08-10T18:36:13+00:00</lastmod>
        <changefreq>monthly</changefreq>
    </url>
    <url>
        <loc>https://sahrebook.com/login</loc>
        <lastmod>2023-08-10T18:36:13+00:00</lastmod>
        <changefreq>monthly</changefreq>
    </url>
    <url>
        <loc>https://sahrebook.com/register</loc>
        <lastmod>2023-08-10</lastmod>
        <changefreq>monthly</changefreq>
    </url>
    <?php
    
        $produk = DB::table('produks')->get();

    ?>
    @foreach ($produk as $item)
        <url>
            <loc>https://sahrebook.com/{{ $item->slug }}</loc>
            <?php
                $originalDate = $item->updated_at;
                $iso8601Date = date('c', strtotime($originalDate));
            ?>
            <lastmod>{{ $iso8601Date }}</lastmod>
        </url>
    @endforeach
    <?php
    
        $berita = DB::table('beritas')->get();

    ?>
    @foreach ($berita as $item)
        <url>
            <loc>https://sahrebook.com/berita-detail/{{ $item->slug }}</loc>
            <?php
                $originalDate = $item->created_at;
                $iso8601Date = date('c', strtotime($originalDate));
            ?>
            <lastmod>{{ $iso8601Date }}</lastmod>
        </url>
    @endforeach
</urlset>
