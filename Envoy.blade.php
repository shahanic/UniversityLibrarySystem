@servers(['localhost'])

@story('deploy')
    update-code
    install-dependencies
@endstory

@task('update-code')
    cd /var/www/uls
    git pull origin master
@endtask

@task('install-dependencies')
    cd /var/www/uls
    composer install
@endtask
