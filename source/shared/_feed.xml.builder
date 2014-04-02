xml.instruct!
xml.feed "xmlns" => "http://www.w3.org/2005/Atom" do
  xml.title blog_title
  xml.subtitle title
  #xml.id URI.join(root_url, blog.options.prefix.to_s)
  #xml.link "href" => URI.join(root_url, blog.options.prefix.to_s)
  #xml.link "href" => URI.join(root_url, current_page.path), "rel" => "self"
  xml.updated(articles.first.date.to_time.iso8601) unless articles.empty?
  xml.author { xml.name author }

  articles.each do |article|
    xml.entry do
      xml.title article.title
      xml.link "rel" => "alternate", "href" => URI.join(root_url, article.url)
      xml.id URI.join(root_url, article.url)
      xml.published article.date.to_time.iso8601
      xml.updated article.date.to_time.iso8601
      xml.author { xml.name author }
      xml.content relative_paths_to_absolute(article.body), "type" => "html"
    end
  end
end
