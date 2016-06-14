/*Project 4 ohhi test

Blake Schewe
bschewe

Mitch Mohr
mohrmi*/




#include <iostream>
#include "ohhi.h"

using namespace std;

int main() {

    int board[10][10];
    int testVar = 0;

    int size_1 = 2;
    int size_2 = 4;
    int size_3 = 6;
    int size_4 = 6;
    int size_5 = 6;
    int size_6 = 4;


    string test_board_1[] = { "BR",
        "-B" };
    string test_board_2[] = { "--BB", "-BR-", "--R-",
        "--RB" };
    string test_board_3[] = { "---BB-", "----R-", "R--R--",
        "BB----", "B-----", "----RB" };
    string test_board_4[] = { "---BRR", "B----R", "--BB--",
        "----RR", "---R-B", "B-----" };
    string test_board_5[] = { "--R--B", "--RR--", "-B----",
        "----R-", "-----R", "----R-" };
    string test_board_6[] = { "-BBB", "RRRB", "-BRB",
        "--R-" };


    read_board_from_string(board, test_board_1, size_1);
    board_has_no_threes(board, size_1);
    solve_balance_row(board, size_1, 0);
    if (board_has_no_duplicates(board, size_1))
        print_board(board, size_4);
    cout << endl;

    read_board_from_string(board, test_board_2, size_2);
    board_has_no_threes(board, size_2);
    if (row_has_no_threes_of_color(board, size_2, 0, BLUE))
        testVar++;
    if (row_has_no_threes_of_color(board, size_2, 0, RED))
        testVar++;
    if (col_has_no_threes_of_color(board, size_2, 3, BLUE))
        testVar++;
    if (col_has_no_threes_of_color(board, size_2, 3, RED))
        testVar++;
    if (testVar == 4)
        print_board(board, size_2);
    cout << endl;

    read_board_from_string(board, test_board_3, size_3);
    testVar = 0;
    solve_three_in_a_row(board, size_3, 0);
    if (rows_are_different(board, size_3, 0, 2))
        testVar++;
    if (rows_are_different(board, size_3, 1, 4))
        testVar++;
    if (cols_are_different(board, size_3, 2, 4))
        testVar++;
    if (cols_are_different(board, size_3, 0, 5))
        testVar++;
    if (testVar == 4)
        print_board(board, size_3);
    cout << endl;

    read_board_from_string(board, test_board_3, size_3);
    solve_three_in_a_row(board, size_3, 0);
    solve_three_in_a_column(board, size_3, 0);
    solve_balance_column(board, size_3, 0);
    print_board(board, size_3);
    cout << endl;

    read_board_from_string(board, test_board_4, size_4);
    solve_three_in_a_row(board, size_4, 2);
    solve_balance_row(board, size_4, 0);
    solve_three_in_a_column(board, size_4, 0);
    solve_balance_column(board, size_4, 0);
    if (cols_are_different(board, size_4, 0, 5))
        print_board(board, size_4);
    if (rows_are_different(board, size_4, 0, 5))
        print_board(board, size_4);
    if  (board_has_no_threes(board, size_1))
        print_board(board, size_4);
    if (board_has_no_duplicates(board, size_4))
        print_board(board, size_4);

    read_board_from_string(board, test_board_5, size_5);
    solve_three_in_a_row(board, size_5, 2);
    solve_balance_row(board, size_5, 0);
    solve_three_in_a_column(board, size_5, 0);
    solve_balance_column(board, size_5, 0);
    if (cols_are_different(board, size_5, 0, 5))
        print_board(board, size_5);
    if (rows_are_different(board, size_5, 0, 5))
        print_board(board, size_5);
    if (board_has_no_threes(board, size_5))
        print_board(board, size_5);
    if (board_has_no_duplicates(board, size_5))
        print_board(board, size_5);
    cout << endl;

    read_board_from_string(board, test_board_6, size_6);
    testVar = 0;
    if (!board_has_no_threes(board, size_6))
        testVar++;
    if (!row_has_no_threes_of_color(board, size_6, 0, BLUE))
        testVar++;
    if (!row_has_no_threes_of_color(board, size_6, 1, RED))
        testVar++;
    if (!col_has_no_threes_of_color(board, size_6, 3, BLUE))
        testVar++;
    if (!col_has_no_threes_of_color(board, size_6, 2, RED))
        testVar++;
    if (testVar == 5)
        print_board(board, size_6);
    cout << endl;
    return 0;
}
