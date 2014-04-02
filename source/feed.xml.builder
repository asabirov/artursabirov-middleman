articles = blog('dev').articles[0..feed_limit] + blog('books').articles[0..feed_limit]
articles = articles.sort_by {|a| a.date}.reverse[0..feed_limit]

xml << partial("shared/feed", locals: {
  title: 'Все разделы',
  articles: articles
})

