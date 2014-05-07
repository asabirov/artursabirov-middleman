---
title: Автоматическое добавление ветки в commit message
alias: append-branch-name-to-commit-message
announce: Git-hook, который сам подставит название текущий ветки в комментарий коммита
date: 2014-05-07 15:12 MSK
tags: git
---

Как многие знают, Jira умеет подцеплять коммиты в историю, если в комментарии указать номер задачи.

Чтобы не писать для каждого коммита номер, собрал простой hook.

~~~
#!/bin/sh
BRANCH=$(git rev-parse --abbrev-ref HEAD)
CURRENT=`grep -e "^[^#]" $1`

if [ -z "$CURRENT" ]
  then
    NEW_MSG=$(echo "$BRANCH"; cat "$1")
    echo "$NEW_MSG" > $1
fi
~~~

Он добавляет название текущей ветки в комментарий, если COMMIT_EDITMSG пуст.

##Установка

~~~
curl https://gist.githubusercontent.com/asabirov/9f40e3d280ee7ad633db/raw/prepare-commit-msg \
    > .git/hooks/prepare-commit-msg
chmod +x .git/hooks/prepare-commit-msg
~~~