### Open Exam V2
    
    OpenExam is an open-source free to use MCQ Web App.

### Note -

    Please note, this is an MVP version. I am not adding any features to this app. Only bug fixes. I am creating the next version with a lot of improvements, which need modification in the database. Follow me on Twitter or Website blog posts for more information.


## Features
    
    OpenExam is open-source and free for non-commercial usage.

    OpenExam enables teachers to create their exams and check their student's progress.

    Hosting email and database are free* and provided by a respected company, no spam.

    No Monthly Bill. You don't need any monthly commitment to run your web-based exam app.

    All your assets are your digital property. Every question, exam and results you prepare are private, which only you are in control.

    Tutorials and step by step how-to have you will help you to solve any problem.

    We have your back. We will help you to make sure your app is running smoothly. We will upgrade this app regularly.

    You can translate the whole web app to your native language, and set it as the app's default language. As a proof of concept, we have translated the whole app into "Bangla" and set it to the default language. Try it out.

 ### Can I use it?

    It is built with teachers in mind, not only help them but solving all tech-related problems. You just concentrate on creating great content for students and we take care of the rest.

 ### Only MCQ?

    Yes! This is an MVP( Minimum viable product ) version of this app. We will add more featrues on they way.

 ### Something is broken! How to ask help?
    
    If you wanted to help with Bugs, then please add Bugsnug. And share the error message. Without this information, we are unable to help.

 ### Is there is a pro version?
    
    No pro of any kind. It's what you see is what you get.

 ### Too good to be true?
    
    Check for yourself. It's all for your eyes only :)

## How do I install ?

Here is a medium example on how to install laravel on Heroku platform.

[Install on a live web server](https://debjit012.medium.com/how-did-i-host-my-blood-donation-diary-app-on-heroku-for-free-be03f8f4e1c9)

But you can also try it on your local machine.

```bash
composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
```

Copy the env file 

```bash
copy .env.example .env
```
Generate key 

```bash
php artisan key:generate
```
Set the dattabase value in App/config/database.php or .env or your deployment enviornment.

Migrate the database

```bash
php artisan migrate --seed
```
Your app is ready to use. Use default username and password for admin is-

```bash
email: admin@admin.com
password : password
```
Now Link your storage for uploads
```bash
php artisan storage:link
```


### Licence
<a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc/4.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/">Creative Commons Attribution-NonCommercial 4.0 International License</a>.
