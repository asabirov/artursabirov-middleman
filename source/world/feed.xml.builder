xml << partial("shared/feed", locals: {
  title: 'Путешествия',
  articles: blog('world').articles.take(feed_limit),
})

