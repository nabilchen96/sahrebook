<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://sahrebook.com/produk</loc>
        <lastmod>2023-08-10</lastmod>
        <changefreq>weekly</changefreq>
    </url>
    <url>
        <loc>https://sahrebook.com/berita</loc>
        <lastmod>2023-08-10</lastmod>
        <changefreq>monthly</changefreq>
    </url>
    <url>
        <loc>https://sahrebook.com/login</loc>
        <lastmod>2023-08-10</lastmod>
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
            <lastmod>{{ $item->updated_at }}</lastmod>
        </url>
    @endforeach
    <?php
    
        $berita = DB::table('beritas')->get();

    ?>
    @foreach ($berita as $item)
        <url>
            <loc>https://sahrebook.com/{{ $item->slug }}</loc>
            <lastmod>{{ $item->created_at }}</lastmod>
        </url>
    @endforeach
</urlset>
