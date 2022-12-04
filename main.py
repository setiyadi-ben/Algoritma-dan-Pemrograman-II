from ast import While
from subprocess import call
import threading # Ref: https://www.geeksforgeeks.org/multithreading-python-set-1/
import time

class groupingSensors:

    # def run_potensio_sensor():
    #     call(["python", "potensio.py"])

    def run_dht_sensor2():
        call(["python", "sensor-dht11.py"])

    def run_hcsr04_sensor3():
        call(["python", "sensor-hcsr04.py"])

if __name__ == "__main__":

    # Listing threads
    # sensor1 = threading.Thread(target = groupingSensors.run_potensio_sensor, name = "sensor1")
    sensor2 = threading.Thread(target = groupingSensors.run_dht_sensor2, name = "sensor2")
    sensor3 = threading.Thread(target = groupingSensors.run_hcsr04_sensor3, name = "sensor3")

    # Starting threads
    # sensor1.start()
    sensor2.start()
    sensor3.start()

    # Joining threads
    # sensor1.join()
    sensor2.join()
    sensor3.join()

    # Looping
    time.sleep(3)