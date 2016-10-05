#include <iostream>
#include <cstring>
#include <algorithm>
#include <cstdio>
#include<map>
using namespace std;

int main () {
        freopen("../resources/input/input-day3.txt","r",stdin);
        freopen("output/output-day3-part1.txt","w",stdout);
        map < pair<int,int>, int> m;
        int x=0,y=0;
        long long answer=0;
        m[pair<int,int> (x,y)] = 1;
        char ch;
        while((scanf("%c",&ch))!=EOF) {                
                if(ch=='^') {
                        y++;
                }
                else if(ch=='v') {
                        y--;
                }
                else if(ch=='>') {
                        x++;
                }
                else if(ch=='<') {
                        x--;
                }
//                if(m.find(pair<int,int> (x,y))==m.end()) {
                      m[pair<int,int> (x,y)] = 1;
 //                     answer++;
 //               }
        }
        answer=m.size();
        printf("%lld",answer);
        fclose(stdout);
        return 0;
}
