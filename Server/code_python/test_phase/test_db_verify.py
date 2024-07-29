#!/usr/bin/env python3
import os
import sqlite3
import datetime
import sys
import pytest

from db_verify import Database

@pytest.fixture
def db():
    db_name = "test_db.db"
    db = Database(db_name)
    yield db
    db.close_connection()
    os.remove(db_name)

def test_create_table(db):
    columns = "id INTEGER PRIMARY KEY, name TEXT, age INTEGER"
    db.create_table("test_table", columns)
    db.cur.execute("PRAGMA table_info(test_table)")
    result = db.cur.fetchall()
    expected = [(0, 'id', 'INTEGER', 0, None, 1),
                (1, 'name', 'TEXT', 0, None, 0),
                (2, 'age', 'INTEGER', 0, None, 0)]
    assert result == expected

def test_insert_data(db):
    db.create_table("test_table", "name TEXT, age INTEGER")
    data = ("Alice", 25)
    db.insert_data("test_table", data)
    db.cur.execute("SELECT * FROM test_table")
    result = db.cur.fetchall()
    expected = [("Alice", 25)]
    assert result == expected

def test_get_data(db):
    db.create_table("test_table", "name TEXT, age INTEGER")
    data = [("Alice", 25), ("Bob", 30)]
    for row in data:
        db.insert_data("test_table", row)
    result = db.get_data("test_table")
    assert result == data

