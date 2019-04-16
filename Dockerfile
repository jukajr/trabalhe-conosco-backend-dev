FROM node

ENV APP_ROOT /src

RUN mkdir ${APP_ROOT}
WORKDIR ${APP_ROOT}
ADD . ${APP_ROOT}

RUN npm i -g @adonisjs/cli

ENV HOST 0.0.0.0