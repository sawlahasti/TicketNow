#include <iostream>
#include <cstring>
#include <algorithm>
#include <cstdio>
#include <map>
using namespace std;

int main () {
        freopen("../resources/input/input-day3.txt","r",stdin);
        freopen("output/output-day3-part2.txt","w",stdout);
        map < pair<int,int>, int> m;
        int x1=0,y1=0,x2=0,y2=0;
        long long answer=0;
        m[pair<int,int> (x1,y1)] = 1;
        char ch;
        int count=0;
        while((scanf("%c",&ch))!=EOF) {
                count++;                
                if(count%2==0) { 
                        if(ch=='^') {
                                y1++;
                        }
                        else if(ch=='v') {
                                y1--;
                        }
                        else if(ch=='>') {
                                x1++;
                        }
                        else if(ch=='<') {
                                x1--;
                        } 
                        m[pair<int,int> (x1,y1)] = 1;
                }
                else {
                        if(ch=='^') {
                                y2++;
                        }
                        else if(ch=='v') {
                                y2--;
                        }
                        else if(ch=='>') {
                                x2++;
                        }
                        else if(ch=='<') {
                                x2--;
                        } 
                        m[pair<int,int> (x2,y2)] = 1;   
                }
        }
        answer=m.size();
        printf("%lld",answer);
        fclose(stdout);
        return 0;
}
