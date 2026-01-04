Slim 4 Swoole websocket + HTTP template
===

This template is made for my personal use, but feel free to use it.

This is a template of Slim 4 microframework running on Swoole with an example websocket and http. 
It's a simple starting point for my various projects. Idea was to refactor what I did some time ago to the point where it's simpler to use for my needs.
There is no database handling in this template. Add it if you need it.
This template might have some bugs or/and could be improved in many ways.

---
### Starting

To start this project simply copy `.env.example` to `.env` and run `docker compose up -d` in a main directory.
Check setup configuration in `src\core\setup\Setup.php` file. 
There you should be able to change http and websocket ports and other stuff related to how this app works.

This template code is split into two parts:
- `src\core` - contains all the setup and configuration files
- `src\` - contains all the setup and configuration files

Ideally you shouldn't have to change anything in `app` directory other that adding other routers if needed.
