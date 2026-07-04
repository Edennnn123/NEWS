with open("C:/wamp/www/news/functions/database.php", 'rb') as f:
    raw = f.read()

# Find the connect die and the close die
idx1 = raw.find(b'mysqli_connect')
idx2 = raw.find(b'mysqli_close')
idx3 = raw.find(b'close_connection')

print("Around connect:")
print(repr(raw[idx1:idx1+120]))
print()
print("Around close:")
print(repr(raw[idx2:idx2+80]))
print()
print("Around close_connection if-block:")
print(repr(raw[idx3-30:idx3+50]))
