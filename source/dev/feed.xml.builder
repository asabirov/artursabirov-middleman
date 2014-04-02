xml << partial("shared/feed", locals: {
  title: 'Разработка',
  articles: blog('dev').articles[0..feed_limit],
})

