#include<iostream>
#include<string>
#include<algorithm>
#include<cstdio>

int main () {
        using namespace std;
        freopen("../resources/input/input-day1.txt","r",stdin);
        freopen("output/output-day1-part1.txt","w",stdout);
        string input,temp;
        getline(cin,input);
        long before = input.length();
        remove_copy(input.begin(),input.end(),back_inserter(temp),'(');
        long after = temp.length();
        long floor = before-(2*after);
        printf("%ld",floor);
        fclose(stdout);
        return 0;
}
