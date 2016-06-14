/**
 * ohhi.cpp
 *
 * EECS 183, Winter 2015
 * Project 4: 0h h1
 *
 * <#Name(s)#>
 *
 * Blake Schewe
 * Mitch Mohr
 * <#uniqname(s)#>
 *
 * bschewe
 * mohrmi
 *
 * <#A description of the project here#>
 */

#include "ohhi.h"

void print_board(const int board[MAX_SIZE][MAX_SIZE], int size) 
{
    // requires if ((size <= MAX_SIZE) && (size > 0) && ((size % 2) == 0))
    for (int row = 0; row < size; row++)
    {
        for (int col = 0; col < size; col++)
        {
            if (board[row][col] == 0)
            {
                cout << "-";
            }
            else if (board[row][col] == 1)
            {
                cout << "R";
            }
            else if (board[row][col] == 2)
            {
                cout << "B";
            }
        }
        cout << endl;
    }
}

bool row_has_no_threes_of_color(const int board[MAX_SIZE][MAX_SIZE],
                                int size,
                                int row,
                                int color) 
{
    // your code here
    int num = 0;

    for (int i = 0; i < (size - 2); i++)
    {
        if ((board[row][i] == color) && (board[row][i + 1] == color) &&
            (board[row][i + 2] == color))
        {
            num++;
        }
    }
    if (num == 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

bool col_has_no_threes_of_color(const int board[MAX_SIZE][MAX_SIZE],
                                int size,
                                int col,
                                int color)
{
    // your code here
    int num = 0;

    for (int i = 0; i < (size - 2); i++)
    {
        if ((board[i][col] == color) && (board[i + 1][col] == color) &&
            (board[i + 2][col] == color))
        {
            num++;
        }
    }
    if (num == 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

bool board_has_no_threes(const int board[MAX_SIZE][MAX_SIZE], int size)
{
    // your code here
    int num = 0;
    for (int i = 0; i < size; i++)
    {
        if (!(row_has_no_threes_of_color(board, size, i, RED)) ||
            !(col_has_no_threes_of_color(board, size, i, RED)) ||
            !(row_has_no_threes_of_color(board, size, i, BLUE)) ||
            !(col_has_no_threes_of_color(board, size, i, BLUE)))
        {
            num++;
        }
    }
    if (num == 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

bool rows_are_different(const int board[MAX_SIZE][MAX_SIZE],
                        int size,
                        int row1,
                        int row2)
{
    int i;
    int rowsAreEqualInColumns = 0;

    for (i = 0; i < size; i++)
    {
        if (((board[row1][i]) == (board[row2][i])) &&
            (board[row1][i] != UNKNOWN))
        {
            rowsAreEqualInColumns++;
        }
    }

    if (rowsAreEqualInColumns == size)
    {
        return false;
    }
    else
    {
        return true;
    }
}

bool cols_are_different(const int board[MAX_SIZE][MAX_SIZE],
                        int size,
                        int col1,
                        int col2)
{
    int i;
    int columnsAreEqualInRows = 0;
    
    for (i = 0; i < size; i++)
    {
        if (((board[i][col1]) == (board[i][col2])) && (board[i][col1] != UNKNOWN))
        {
            columnsAreEqualInRows++;
        }
    }
    
    if (columnsAreEqualInRows == size)
    {
        return false;
    }
    else
    {
        return true;
    }
}

bool board_has_no_duplicates(const int board[MAX_SIZE][MAX_SIZE], int size) 
{
    int num = 0;
    int algorithm = size - 1;
    int x = 0;

    for (; algorithm > 0; algorithm--)
    {
        x += algorithm;
    }

    for (int i = 0; i < (size - 1); i++)
    {
        for (int j = (i + 1); j < size; j++)
        {
            if ((rows_are_different(board, size, i, j)) &&
                (cols_are_different(board, size, i, j)))
            {
                num++;
            }
        }
    }
    if (num == x)
    {
        return true;
    }
    else
    {
        return false;
    }
}

void solve_three_in_a_row(int board[MAX_SIZE][MAX_SIZE],
                          int size,
                          int row) 
{
    int i;
    //going through the individual rows of the board
    for (i = 0; i < (size - 2); i++)
    {
        //if the color at position i is RED
        if (board[row][i] == 1) 
        {

            if ((board[row][i + 1] == 1) && (board[row][i + 2] != 2))
            {
                if ((i + 2) < size)
                {
                    mark_square_as(board, size, row, (i + 2), BLUE);
                }
            }
            if ((board[row][i + 2] == 1) && (board[row][i + 1] != 2))
            {
                if ((i + 2) < size)
                {
                    mark_square_as(board, size, row, (i + 1), BLUE);
                }
            }
        }
        //if the color at position i is BLUE
        else if (board[row][i] == 2)
        {
            if ((board[row][i + 1] == 2) && (board[row][i + 2] != 1))
            {
                if ((i + 2) < size)
                {
                    mark_square_as(board, size, row, (i + 2), RED);
                }
            }
            if ((board[row][i + 2] == 2) && (board[row][i + 1] != 1))
            {
                if ((i + 2) < size)
                {
                    mark_square_as(board, size, row, (i + 1), RED);
                }
            }
        }
        //if the color at position i is UNKNOWN
        else 
        {
            if ((board[row][i + 1] == 1) && (board[row][i + 2] == 1))
            {
                mark_square_as(board, size, row, (i), BLUE);
                if (((i + 3) < size) && (board[row][i + 3] != 2))
                    mark_square_as(board, size, row, (i + 3), BLUE);
            }
            if ((board[row][i + 1] == 2) && (board[row][i + 2] == 2))
            {
                mark_square_as(board, size, row, (i), RED);
                if (((i + 3) < size) && (board[row][i + 3] != 1))
                    mark_square_as(board, size, row, (i + 3), RED);
            }
        }
   }
}

void solve_three_in_a_column(int board[MAX_SIZE][MAX_SIZE],
    int size,
    int col)
{
    int i;

    //going through the individual columns of the board
    for (i = 0; i < (size - 2); i++)
    {
        //if the color at position i is RED
        if (board[i][col] == 1)
        {

            if ((board[i + 1][col] == 1) && (board[i + 2][col] != 2))
            {
                if ((i + 2) < size)
                {
                    mark_square_as(board, size, (i + 2), col, BLUE);
                }
            }
            if ((board[i + 2][col] == 1) && (board[i + 1][col] != 2))
            {
                if ((i + 2) < size)
                {
                    mark_square_as(board, size, (i + 1), col, BLUE);
                }
            }
        }
        //if the color at position i is BLUE
        else if (board[i][col] == 2)
        {
            if ((board[i + 1][col] == 2) && (board[i + 2][col] != 1))
            {
                if ((i + 2) < size)
                {
                    mark_square_as(board, size, (i + 2), col, RED);
                }
            }
            if ((board[i + 2][col] == 2) && (board[i + 1][col] != 1))
            {
                if ((i + 2) < size)
                {
                    mark_square_as(board, size, (i + 1), col, RED);
                }
            }
        }
        //if the color at position i is UNKNOWN
        else
        {
            if ((board[i + 1][col] == 1) && (board[i + 2][col] == 1))
            {
                mark_square_as(board, size, i, col, BLUE);
                if (((i + 3) < size) && (board[i + 3][col] != 2))
                    mark_square_as(board, size, (i + 3), col, BLUE);
            }
            if ((board[i + 1][col] == 2) && (board[i + 2][col] == 2))
            {
                mark_square_as(board, size, i, col , RED);
                if (((i + 3) < size) && (board[i + 3][col] != 1))
                    mark_square_as(board, size, (i + 3), col, RED);
            }
        }
    }
}

void solve_balance_row(int board[MAX_SIZE][MAX_SIZE], int size, int row) 
{
    int i;
    int redCount = 0;
    int blueCount = 0;
    for (i = 0; i < size; i++)
    {
        if (board[row][i] == RED)
        {
            redCount++;
        }
        else if (board[row][i] == BLUE)
        {
            blueCount++;
        }
    }

    if ((blueCount) == (size / 2))
    {
        for (int j = 0; j < size; j++)
        {
            if (board[row][j] == UNKNOWN)
            {
                mark_square_as(board, size, row, j, RED);
            }
        }
    }
    else if ((redCount) == (size / 2))
    {
        for (int k = 0; k < size; k++)
        {
            if (board[row][k] == UNKNOWN)
            {
                mark_square_as(board, size, row, k, BLUE);
            }
        }
    }
}

void solve_balance_column(int board[MAX_SIZE][MAX_SIZE], int size, int col) 
{
    int i;
    int redCount = 0;
    int blueCount = 0;
    for (i = 0; i < size; i++)
    {
        if (board[i][col] == RED)
        {
            redCount++;
        }
        else if (board[i][col] == BLUE)
        {
            blueCount++;
        }
    }

    if ((blueCount) == (size / 2))
    {
        for (int j = 0; j < size; j++)
        {
            if (board[j][col] == UNKNOWN)
            {
                mark_square_as(board, size, j, col, RED);
            }
        }
    }
    else if ((redCount) == (size / 2))
    {
        for (int k = 0; k < size; k++)
        {
            if (board[k][col] == UNKNOWN)
            {
                mark_square_as(board, size, k, col, BLUE);
            }
        }
    }
}

void solve_lookahead_row(int board[MAX_SIZE][MAX_SIZE],
                         int size,
                         int row) {
    // THIS IS ONLY NEEDED FOR S'MORE
    // your code here
}

void solve_lookahead_column(int board[MAX_SIZE][MAX_SIZE],
                            int size,
                            int col) {
    // THIS IS ONLY NEEDED FOR S'MORE
    // your code here
}
