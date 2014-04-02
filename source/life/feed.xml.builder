xml << partial("shared/feed", locals: {
  title: 'Жизнь',
  articles: blog('life').articles.take(feed_limit),
})

