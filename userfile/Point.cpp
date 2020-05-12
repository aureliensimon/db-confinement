#include "Point.h"

Point::Point(){
  cout << constructeur<< endl;
  x=0;
  y=0;
}

Point::Point(int x,int y){
  cout << constructeur<< endl;
  this->x=x;
  this->y=y;
}
void Point::affiche(){
cout <<"x:" <<x <<"y:" <<y << endl;
}
Point::~Point (){
  cout << destructeur<< endl;
}
