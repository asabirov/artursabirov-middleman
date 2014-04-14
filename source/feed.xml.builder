articles = blog_instances.map{|blog| blog.last.data.articles.take(feed_limit)}.flatten
articles = articles.sort_by {|a| a.date}.reverse.take(feed_limit)

xml << partial("shared/feed", locals: {
  title: 'Все разделы',
  articles: only_published(articles)
})

