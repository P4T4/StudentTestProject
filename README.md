<div id="header" align="center">
  <img src="https://media.giphy.com/media/M9gbBd9nbDrOTu1Mqx/giphy.gif" width="100"/>
</div>

# StudentTestProject
## There are 2 projects in this folder correlate with FrontEnd (frontStudentProject) And BackEnd (apiProject)
### frontStudentProject
To test the project you have to run 2 scripts from batch:
- npm run dev (to run the complements of vite new of Laravel)
- php artisan serve (to solve the problem with redirections of inertia)

Then you can test the page, but you have to register in the page and you continue in the dashboard
---
### apiProject
To test the apiProject only you need to solve the migrations and connect with database, the methods are:
- GET/
- GET/version
- POST/login
- POST/api/logout
- POST/api/refresh
- GET/api/user-profile
- POST/api/store
- POST/api/update
- POST/api/delete
- GET/api/list
- GET/api/getById

The way to consume the request is, for example:
- If you run from xampp: http://localhost/testProject/apiProject/public/api/list
- If you run from "php artisan serve": http://127.0.0.1:8000/api/list

That's it, i apreciate your comments
