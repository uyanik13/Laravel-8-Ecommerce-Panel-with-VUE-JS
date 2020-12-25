<xml version="1.0" encoding="UTF-8">
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

        <url>
            <loc>{{ env('APP_URL') }}</loc>
            <lastmod>{{ $now }}</lastmod>
            <changefreq>Daily</changefreq>
            <priority>0.8</priority>
        </url>

        @foreach ($posts as $post)
            @php
            $url = $post->category ? $post->category->slug.'/'.$post->slug : $post->slug ;
            @endphp
            <url>
                <loc>{{ env('APP_URL') . '/' . $url }}</loc>
                <lastmod>{{ $post->created_at->toAtomString() }}</lastmod>
                <changefreq>Daily</changefreq>
                <priority>0.8</priority>
            </url>
        @endforeach
    </urlset>
</xml>
