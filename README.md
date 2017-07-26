# Very much a work in `progress`, do not use (just yet).

This is a selenium project that automatically congratulates all your Facebook friends on their birthday.


### To Run
1. `composer install`
1. Run `java -jar selenium-server-standalone-3.4.0.jar`
2. Run (In another tab) `php facebook congratulate [FACEBOOK_EMAIL] [FACEBOOK_PASSWORD]`
   Example : `php facebook congratulate fb@example.com myp4ssw0rd`
   
3. Everybody should be congratulated.

####  Todo:

- Check what country people come from; and congratulate them in their language
- Check if a person is dead; you don't want to congratulate dead people

