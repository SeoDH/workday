# 평일 수 구하는 API

#### 언어 : PHP

#### 실행 : `php -S localhost:80 -t public`

#### endpoint : http://localhost/api/workdays

#### params :   
>start - 시작일 (날짜 형식 required.)  
>end - 종료일 (날짜 형식 required.)  
>week - 요일 (integer 형식 option) = 1:월요일~7:일요일

##### sample : http://localhost/api/workdays?start=2018-05-04&end=2019-05-11&week=6
