#!/usr/bin/env python3
import sqlite3
import datetime
import sys
class Database:
    def __init__(self, db_name):
        self.conn = sqlite3.connect(db_name)
        self.cur = self.conn.cursor()
        
    def create_table(self, table_name, columns):
        self.cur.execute(f"CREATE TABLE IF NOT EXISTS {table_name} ({columns})")
        self.conn.commit()

    def insert_data(self, table_name, data):
        placeholders = ", ".join(["?" for _ in range(len(data))])
        self.cur.execute(f"INSERT INTO {table_name} VALUES ({placeholders})", data)
        self.conn.commit()

    def get_data(self, table_name):
        self.cur.execute(f"SELECT * FROM {table_name}")
        rows = self.cur.fetchall()
        return rows

    def close_connection(self):
        self.conn.close()
def main():
    attribute1 = sys.argv[1]
    attribute2 = sys.argv[2]
    now=str(datetime.datetime.now())
    db = Database("history_db.db")
    #verify if the database exists
    if db is  None:
        print("Error! cannot create the database connection.")
    db.create_table("history", "Time TEXT, action Text")
    if(attribute1=="insert"):
        db.insert_data("history", (now, attribute2))
    if(attribute1=="history" and attribute2=="get"):
        print(db.get_data("history"))
#this condition is used to check if the file is being run directly or imported 
#if it is imported then the main() function will not be called
if __name__ == "__main__":
    main()