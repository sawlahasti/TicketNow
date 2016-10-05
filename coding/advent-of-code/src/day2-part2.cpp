#include <iostream>
#include <cstring>
#include <algorithm>
#include <cstdio>
using namespace std;

int main () {
        freopen("../resources/input/input-day2.txt","r",stdin);
        freopen("output/output-day2-part2.txt","w",stdout);
        long long answer=0;
        int a[3];
        while((scanf("%dx%dx%d",&a[0],&a[1],&a[2]))!=EOF) {
                sort(a,a+3);
                answer+=2*(a[0])+2*(a[1])+a[0]*a[1]*a[2];
        }    
        printf("%lld",answer);
        fclose(stdout);
        return 0;
}
