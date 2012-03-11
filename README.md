# Wybe

A work-in-progress PHP 5.3 framework (not for production use). To try it out, download the code and go to e.g. http://localhost:8080/wybe/index.php/users/username to see an example.

Route actions are defined using closures, making it very light-weight and perhaps most appropriate for small applications. The autoloader is based on PSR-0, which means it is easy to incorporate external libraries that use the same standard.