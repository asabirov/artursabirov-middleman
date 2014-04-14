xml << partial("shared/feed", locals: {
  title: 'Путешествия',
  articles: only_published(blog('world').articles).take(feed_limit)
})

