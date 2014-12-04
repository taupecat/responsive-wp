## Starting a project

1. Clone this repository from GitHub (https://github.com/RP3Agency/wordpress-boilerplate.git) and rename it to reflect your project.
2. Update "Vagrantfile" and set the IP address to something that won't conflict with anything else running on the host system, and set your hostmanager settings to your dev URL, minus the "http://".
3. Update "Gemfile" with the ruby gems (along with the version numbers) that you need for your project.
4. Update "composer.json" with the WordPress plugins you need (and update the version of WordPress core if it's not up to date).
5. Edit "package.json" with the project information and the gulp plugins you need.
6. Edit "gulpfile.js" with the proper directory to the custom theme you're developing.
7. *If* using Compass, edit "config.rb" with desired Sass/Compass plugins and paths to the theme directory.
8. Update "wp-config.php" with the proper database credentials for local development. Also update the database table prefix to something other than "wp_" and update the authentication salts.
9. Edit the provision/bootstrap.sh file and supply values for the variables specified at the top, making sure that the database password is the same one you specified in "wp-config.php".
10. `vagrant up` You may be prompted for your machine's password at some point in order to update the /etc/hosts file.

After all of this is done and your project is up and running, remove the .git/ directory and create a new repository for the project on Beanstalk.

All automation tasks — composer, gulp, etc. — should be run from within the vagrant virtual machine, not the host system.

## TODO

Write a script that automates the process listed above.
