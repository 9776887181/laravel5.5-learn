## laravel-s learn


### nginx配置

	map $http_upgrade $connection_upgrade {
	    default upgrade;
	    ''      close;
	}

	upstream laravel5-5 {
	    server workspace:5200 weight=5 max_fails=3 fail_timeout=30s;
	    keepalive 16;
	}

	server {
		location / {
		     #try_files $uri $uri/ /index.php$is_args$args;
		     try_files $uri @laravel5-5;
		}

		location =/ws {
		    # 如果60秒内被代理的服务器没有响应数据给Nginx，那么Nginx会关闭当前连接
		    proxy_read_timeout 60s;
		    proxy_http_version 1.1;
		    proxy_set_header X-Real-IP $remote_addr;
		    proxy_set_header X-Real-PORT $remote_port;
		    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
		    proxy_set_header Host $http_host;
		    proxy_set_header Scheme $scheme;
		    proxy_set_header Server-Protocol $server_protocol;
		    proxy_set_header Server-Name $server_name;
		    proxy_set_header Server-Addr $server_addr;
		    proxy_set_header Server-Port $server_port;
		    proxy_set_header Upgrade $http_upgrade;
		    proxy_set_header Connection $connection_upgrade;
		    proxy_pass http://laravel5-5;
		}

		location @laravel5-5 {
		    proxy_http_version 1.1;
		    proxy_set_header Connection "";
		    proxy_set_header X-Real-IP $remote_addr;
		    proxy_set_header X-Real-PORT $remote_port;
		    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
		    proxy_set_header Host $http_host;
		    proxy_set_header Scheme $scheme;
		    proxy_set_header Server-Protocol $server_protocol;
		    proxy_set_header Server-Name $server_name;
		    proxy_set_header Server-Addr $server_addr;
		    proxy_set_header Server-Port $server_port;
		    proxy_pass http://laravel5-5;
		}
	}	