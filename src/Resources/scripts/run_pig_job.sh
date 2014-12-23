#!/bin/bash
set -e

#$ pig -param_file freightCostCalc-Params.pig freightCostCalc.pig

export JAVA_HOME=/usr/lib/jvm/java-7-openjdk-i386/
export HADOOP_INSTALL=/usr/local/hadoop
export HADOOP_MAPRED_HOME=$HADOOP_INSTALL
export HADOOP_COMMON_HOME=$HADOOP_INSTALL
export HADOOP_HDFS_HOME=$HADOOP_INSTALL
export YARN_HOME=$HADOOP_INSTALL
export SQOOP_HOME=/usr/local/sqoop
export PIG_HOME=/usr/local/pig
export PATH=$PATH:$HADOOP_INSTALL/bin:$HADOOP_INSTALL/sbin:$SQOOP_HOME/bin:$PIG_HOME/bin

pig "$@"
hadoop fs -copyToLocal hdfs://localhost:9000/user/hduser/work/scriptResults/part-m-00000 /var/www/freight-cost-calculator/web/scriptResults/results.txt