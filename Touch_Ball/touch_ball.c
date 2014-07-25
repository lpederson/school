// Title: Touch Ball
// Author: Luke Pederson
// Abstract: Has countdown timer. You touch the ball with the player to score. Arrows OR WASD to move.
// ID: 9786
// Date: 11/3/12

#include "allegro.h"

// Game vars
volatile int sec;
int score;
int timer;
#define TIME 90
#define REST 20
#define p_speed 4
#define p_height 50
#define white makecol(255,255,255)
#define black makecol(0,0,0)

struct TagPlayer{
	int x,y;
	BITMAP * bmp;
} p;
struct TagBall{
	int x,y;
	BITMAP * bmp;
} b;
MIDI * music;
BITMAP * buffer;

//Prototypes
void gameInit();
void destroyGame();
void loadFiles();
void move(char dir);
void getInput();
void spawnBall();
void collideCheck();
void updateDisplay();
void inc_sec(void);

int main(void){
	gameInit();
	while (timer > 0 && !key[KEY_ESC]){
		getInput();
		collideCheck();
		updateDisplay();
	}
	destroyGame();
	return 0;
}
END_OF_MAIN()

//Functions
void gameInit(){
	allegro_init();
	install_keyboard();
	install_timer();
	set_color_depth(32);
	set_gfx_mode(GFX_SAFE, 640, 480, 0, 0);
	clear_to_color(screen, makecol(255, 255, 255));
	if (install_sound(DIGI_AUTODETECT, MIDI_AUTODETECT, NULL) != 0) 
    {
        allegro_message("Error initializing sound system\n%s\n", allegro_error);
        exit(1);
    }

	score = 0;
	timer = TIME;
	LOCK_VARIABLE(sec);
	LOCK_FUNCTION(inc_sec);
	install_int(inc_sec,1000);
	
	loadFiles();
	if(play_midi(music,0) != 0){
		allegro_message("Error playing midi: %s",allegro_error);
		exit(1);
	}

	p.x = SCREEN_W/2 - p.bmp->w/2;
	p.y = SCREEN_H/3 + p.bmp->h;
	spawnBall();
}
void destroyGame(){
	updateDisplay();
	textprintf_ex(screen,font, SCREEN_W/2 - 40,SCREEN_H/2-10,white,black,"GAME OVER");
	textprintf_ex(screen,font, SCREEN_W/2 - 50,SCREEN_H/2,white,black,"Press [ESC] to exit.");
	while(!key[KEY_ESC]){}

	destroy_bitmap(p.bmp);
	destroy_bitmap(b.bmp);
	destroy_bitmap(buffer);
	stop_midi();
	destroy_midi(music);
	allegro_exit();
}
void loadFiles(){
	p.bmp = load_bitmap("player.bmp",NULL);
	b.bmp = load_bitmap("ball.bmp",NULL);
	buffer = create_bitmap(SCREEN_W,SCREEN_H);
	music = load_midi("music.mid");
	if(!p.bmp || !b.bmp){
		allegro_message("Error loading bitmap");
		exit(1);
	}
	if(!music){
		allegro_message("Error loading midi");
		exit(1);
	}
}
void move(char dir){
	switch(dir){
	case 'u':
		p.y-= p_speed;
		break;
	case 'd':
		p.y+= p_speed;
		break;
	case 'l':
		p.x-= p_speed;
		break;
	case 'r':
		p.x+= p_speed;
		break;
	}
}
void getInput(){
	if(keypressed()){
		if(key[KEY_UP] || key[KEY_W]){
			move('u'); return; 
		}
		if(key[KEY_DOWN] || key[KEY_S]){
			move('d'); return;
		}
		if(key[KEY_LEFT] || key[KEY_A]){
			move('l'); return;
		}
		if(key[KEY_RIGHT] || key[KEY_D]){
			move('r'); return;
		}
	}
}
void spawnBall(){
	////////////////////////////////////////////////////////////////////////////////HERE
	// X & Y detection
	do{
		b.x = rand() % (SCREEN_W-b.bmp->w) + 1;
	}while(b.x <= p.x+p.bmp->w && b.x+b.bmp->w >= p.x+p.bmp->w);
	do{
		b.y = rand() % (SCREEN_H-p_height-b.bmp->h) + p_height + 1;
	}while(b.y >= p.y && b.y+b.bmp->h <= p.y+p.bmp->h);
	draw_sprite(buffer,b.bmp,b.x,b.y);
	//blit(b.bmp,buffer,0,0,b.x,b.y,b.bmp->w,b.bmp->h);
}
void collideCheck(){
	if(p.x <= 0)
		p.x = 0;
	if(p.y <= p_height)
		p.y = p_height+1;
	if(p.x + p.bmp->w >= SCREEN_W)
		p.x = SCREEN_W - p.bmp->w;
	if(p.y + p.bmp->h >= SCREEN_H)
		p.y =  SCREEN_H - p.bmp->h;

	if(b.x >= p.x && b.x+b.bmp->w <= p.x+p.bmp->w && b.y >= p.y && b.y+b.bmp->h <= p.y+p.bmp->h){
		score++;
		spawnBall();
	}
}
void updateDisplay(){
	clear_bitmap(buffer);
	textprintf_ex(buffer,font,10,30,white,black,"Time Remaining: %d:%.2d                              Score: %d",(int)timer/60,(int)timer%60,(int)score);
	rectfill(buffer,0,p_height-10,SCREEN_W,p_height,white);
	draw_sprite(buffer,b.bmp,b.x,b.y);
	draw_sprite(buffer,p.bmp,p.x,p.y);
	//blit(b.bmp,buffer,0,0,b.x,b.y,b.bmp->w,b.bmp->h);
	//blit(p.bmp,buffer,0,0,p.x,p.y,p.bmp->w,p.bmp->h);
	blit(buffer,screen,0,0,0,0,SCREEN_W-1,SCREEN_H-1);
	rest(REST);
}
void inc_sec(void){ sec++; timer--; }
END_OF_FUNCTION(inc_sec)