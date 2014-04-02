xml << partial("shared/feed", locals: {
  title: 'Обзор книг',
  articles: blog('books').articles[0..5]
})

