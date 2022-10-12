import turtle 
  
 def draw(tur,screen,color): 
     tur.speed(10) 
     screen.clear() 
     tur.penup() 
     tur.setpos(0,-70) 
     tur.pensize(12) 
     if color == 1: 
         tur.color("black","orange") 
     else: 
         tur.color("black","gray") 
     tur.pendown() 
     tur.begin_fill() 
     tur.circle(100) 
     tur.end_fill() 
     tur.penup() 
     tur.setpos(0,150) 
     if color == 0: 
         tur.color("black","red") 
     else: 
         tur.color("black","gray") 
     tur.pendown() 
     tur.begin_fill() 
     tur.circle(100) 
     tur.end_fill() 
     tur.penup() 
     tur.setpos(0,-290) 
     if color == 2: 
         tur.color("black","green") 
     else: 
         tur.color("black","gray") 
     tur.pendown() 
     tur.begin_fill() 
     tur.circle(100) 
     tur.end_fill() 
     tur.penup() 
     tur.hideturtle() 
  
  
 screen = turtle.Screen() 
 tur = turtle.Turtle() 
 color = int(input("Enter color number\n")) 
 draw(tur,screen,color) 
 turtle.done()
