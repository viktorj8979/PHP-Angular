Marketplace on top of AngularJS and Symfony3 - http://aisel.co/

Demo:<br/>
Frontend: http://ecommerce.aisel.co/en/ [user@aisel.co/user]<br/>
Admin: http://admin.ecommerce.aisel.co/en/ [admin@aisel.co/admin]<br/>
Seller: http://admin.ecommerce.aisel.co/en/ [seller@aisel.co/seller]<br/>

<img width="400" src="http://aisel.co/images/frontend_product_view.png"/>


Installation
-----------------------------------
1. git clone git@github.com:ivanproskuryakov/Aisel.git
2. cd Aisel
3. composer install
4. bin/console aisel:install
5. Give permissions to following directories: 
 - app/cache/
 - app/var/
 - app/logs/
 - web/media/
```

Requirements:<br/>
```
Node.js and NPM
Bower
Grunt
```


Installation with [Vagrant](https://www.vagrantup.com/)
-----------------------------------
Add to /etc/hosts and open http://aisel.dev/en/<br/>
```
192.168.50.4   api.aisel.dev
192.168.50.4   aisel.dev
192.168.50.4   admin.aisel.dev
```
Launch vagrant box
```
vagrant up
```
Destroy and re-launch vagrant box
```
vagrant halt && vagrant destroy -f && vagrant up
```
