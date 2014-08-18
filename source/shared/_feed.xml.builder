xml.instruct!
xml.feed "xmlns" => "http://www.w3.org/2005/Atom" do
  xml.title blog_title
  xml.subtitle title
  xml.updated(articles.first.date.to_time.iso8601) unless articles.empty?
  xml.author { xml.name author }

  articles.each do |article|
    prefix = article.data.category_name ? "#{article.data.category_name}: " : ''
    body = with_image(article)
    body = relative_paths_to_absolute(body)


    xml.entry do
      xml.title "#{prefix}#{article.title}"
      xml.link "rel" => "alternate", "href" => URI.join(root_url, article.url)
      xml.id URI.join(root_url, article.url)
      xml.published article.date.to_time.iso8601
      xml.updated article.date.to_time.iso8601
      xml.author { xml.name author }
      xml.content body, "type" => "html"
    end
  end
end
