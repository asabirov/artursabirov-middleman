xml << partial("shared/feed", locals: {
  title: 'Разработка',
  articles: blog('dev').articles.take(feed_limit),
})

