<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc>{{ env('APP_URL') }}</loc>
        <lastmod>{{ $now }}</lastmod>
        <changefreq>Daily</changefreq>
        <priority>0.8</priority>
    </url>

    @foreach($posts as $post)
        @php
            $newPost = post_to_each_langauge($post);
        @endphp

        @foreach ($newPost as $item)
            @php
                  $url = $item->category ? $item->category.'/'.$item->slug : $item->slug ;
            @endphp
            <url>
            <loc>{{env('APP_URL').'/'.$url}}</loc>
            <lastmod>{{ $item->created_at->toAtomString() }}</lastmod>
            <changefreq>Daily</changefreq>
            <priority>0.8</priority>
        </url>
        @endforeach
    @endforeach
</urlset>
