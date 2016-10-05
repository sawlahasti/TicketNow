#include<iostream>
#include<string>
#include<algorithm>
#include<cstdio>
#include<stack>

int main () {
        using namespace std;
        freopen("../resources/input/input-day1.txt","r",stdin);
        freopen("output/output-day1.txt","w",stdout);
        string input;
        stack <char> stk;
        getline(cin,input);
        int i=0;
        for(i=0;i<input.length();i++) {
                if(input[i]=='(')
                        stk.push(input[i]);
                else {
                        if(!stk.empty()) {
                                stk.pop();
                        }
                        else {
                                break;
                        }
                } 
        }
        printf("%d",(i+1));
        fclose(stdout);
        return 0;
}
