xml << partial("shared/feed", locals: {
  title: 'Разработка',
  articles: only_published(blog('dev').articles).take(feed_limit)
})

