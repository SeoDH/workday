# 평일 수 구하는 API

#### 언어 : PHP

#### 사전작업
1. `.env` 파일 생성
```
APP_NAME=Lumen
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost
APP_TIMEZONE=Asia/Seoul

LOG_CHANNEL=stack
LOG_SLACK_WEBHOOK_URL=

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=default
DB_USERNAME=default
DB_PASSWORD=secret

CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```
2. composer 실행
```
$ composer install
$ composer update
```

#### 실행 : `php -S localhost:80 -t public`

#### endpoint : http://localhost/api/workdays

#### params :   
>start - 시작일 (날짜 형식 required.)  
>end - 종료일 (날짜 형식 required.)  
>week - 요일 (integer 형식 option) = 1:월요일~7:일요일

##### sample : http://localhost/api/workdays?start=2019-05-01&end=2019-05-31&week=1
```
{
    days: 4
}
```
