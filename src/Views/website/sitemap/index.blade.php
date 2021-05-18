<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($urls as $url)
    <url>
        <loc>{{ data_get($url,"loc") }}</loc>
        <lastmod>{{ data_get($url,"lastmod") }}</lastmod>
        <changefreq>{{ data_get($url,"changefreq") }}</changefreq>
        <priority>{{ data_get($url,"priority") }}</priority>
    </url>
    @endforeach
</urlset>