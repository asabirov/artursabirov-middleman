xml << partial("shared/feed", locals: {
  title: 'Обзор книг',
  articles: only_published(blog('books').articles).take(5)
})

