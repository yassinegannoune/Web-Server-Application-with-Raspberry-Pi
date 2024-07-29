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
